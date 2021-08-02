<template>
  <div>
    <!-- Pagination -->
    <div 
      v-show="!loading"
      class="row justify-content-center"
    >
      <b-pagination
        v-model="currentPage"
        :items="pokemons"
        :total-rows="totalPokemon"
        :per-page="20"
        first-number
        last-number
        @input="changePage"
        class="mt-3"
      >
      </b-pagination>
    </div>
    <div
      v-if="!loading" 
      class="row"
    >
      <div 
        v-for="pokemon in pokemons"
        class="col-md-3 mb-4"
      >
        <Card 
          :name="pokemon.name"
          :sprite="pokemon.sprite"
          :types="pokemon.types"
        />
      </div>
    </div>
    <div 
      v-else
      class="row justify-content-center mt-5"
    >
      <b-spinner style="width: 3rem; height: 3rem;" label="Loading..." />
    </div>
  </div>
</template>

<script>
  import Card from './Card.vue'

  export default {
    name: 'Home',
    components: {
      Card
    },
    data () {
      return {
        pokeApi: 'https://pokeapi.co/api/v2',
        pokemons: [],
        totalPokemon: 0,
        currentPage: 1,
        loading: false
      }
    },
    mounted () {
      this.getAllPokemon(`${this.pokeApi}/pokemon?limit=20&offset=0`)
    },
    methods: {
      changePage () {
        let getOffest = (this.currentPage - 1) * 20
        this.pokemons = []
        this.getAllPokemon(`${this.pokeApi}/pokemon?limit=20&offset=${getOffest}`)
      },
      getAllPokemon (url) {
        this.loading = true
        axios.get(url)
        .then((res) => {
          this.totalPokemon = res.data.count
          // To get the details of a Pokemon
          let pokemon = res.data.results
          for (let index in res.data.results) {
            setTimeout(() => {
              this.getPokemonDetail(pokemon[index].name)
            }, 1000) 
          }
        })
        .catch((err) => {
          console.log(err)
        })
        .finally(() => {
          setTimeout(() => {
            this.loading = false
          }, 1000)
        })
      },
      getPokemonDetail: async function (pokemon) {
        axios.get(`${this.pokeApi}/pokemon/${pokemon}`)
        .then((res) => {
          this.pokemons.push({
            // To capitalize the first letter of the name
            'name': res.data.species.name,
            'types': res.data.types,
            'sprite': res.data.sprites.front_default
          })
        })
        .catch((err) => {
          console.log(err)
        })
      }
    }
  }
</script>
