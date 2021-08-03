<template>
  <div>
    <div class="row justify-content-center mt-2">
      <Alert 
        :displayAlert="displayAlert"
        :message="alertMessage"
        :type="colorType"
        @closeAlert="closeAlert"
      />
    </div>
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
          :image="pokemon.sprite"
          :pokemonType="pokemon.types"
          :setHeight="true"
          @likePokemon="likePokemon"
          @dislikePokemon="dislikePokemon"
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
  import Alert from './Alert.vue'

  export default {
    name: 'Home',
    components: {
      Card,
      Alert
    },
    data () {
      return {
        userId: localStorage.getItem('userId'),
        pokeApi: 'https://pokeapi.co/api/v2',
        userPokemons: [],
        pokemons: [],
        totalPokemon: 0,
        currentPage: 1,
        loading: false,
        alertMessage: '',
        displayAlert: false,
        colorType: ''
      }
    },
    mounted () {
      this.getAllPokemon(`${this.pokeApi}/pokemon?limit=20&offset=0`)
    },
    methods: {
      closeAlert () {
        this.displayAlert = false
      },
      likePokemon (pokemon) {
        axios.post(`/api/user/pokemon/like`, { 
          pokemon_name: pokemon
         })
         .then((res) => {
            this.alertMessage = res.data.message
            this.displayAlert = true
            this.colorType = 'primary'
            this.getUserPokemon()
         })
         .catch((err) => {
           console.log(err)
         })
      },
      dislikePokemon (pokemon) {
        axios.post(`/api/user/pokemon/dislike`, { 
          pokemon_name: pokemon
         })
         .then((res) => {
           this.alertMessage = res.data.message
           this.displayAlert = true
           this.colorType = 'danger'
           this.getUserPokemon()
         })
         .catch((err) => {
           console.log(err)
         })
      },
      changePage (pokemon) {
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
            this.getUserPokemon()
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
      },
      // Remove pokemons from list if liked or disliked by user
      // A bit buggy sometimes doesn't remove a Pokemon from the list
      getUserPokemon (pokemon) {
        axios.get(`/api/user/${this.userId}/pokemon`)
        .then((res) => {
          this.userPokemons = res.data.liked.concat(res.data.disliked)
              for (var i = 0, len = this.userPokemons.length; i < len; i++) { 
                for (var j = 0, len2 = this.pokemons.length; j < len2; j++) { 
                    if (this.userPokemons[i].pokemon_name === this.pokemons[j].name) {
                        this.pokemons.splice(j, 1);
                        len2=this.pokemons.length;
                    }
                }
            }
        })
        .catch((err) => {
          console.log(err)
        })
      }
    }
  }
</script>
