<template>
  <div class="row container mt-5">
    <div 
      v-for="trainer in trainers"
      class="col-md-3"
    >
      <Card
        :name="trainer.username"
        :userFullName="setFullName(trainer)"
        :image="trainerImg"
        :cardType="'trainer'"
        :birthday="trainer.date_of_birth"
        :setHeight="true"
      >
        <template v-slot:trainer-pokemons>
          <div>
            <b>Liked Pokemon:</b>
            <ul>
              <li 
                v-for="pokemon in trainer.user_likes_dislikes"
                v-if="pokemon.is_liked"
              >
                {{ pokemon.pokemon_name }}
              </li>
            </ul>
          </div>
          <div>
            <b>Disliked Pokemon:</b>
            <ul>
              <li 
                v-for="pokemon in trainer.user_likes_dislikes"
                v-if="pokemon.is_disliked"
              >
                {{ pokemon.pokemon_name }}
              </li>
            </ul>
          </div>
        </template>
      </Card>
    </div>
  </div>
</template>

<script>
  import Card from './Card.vue';

  export default {
    name: 'Trainer',
    components: {
      Card
    },
    data () {
      return {
        trainers: [],
        trainerImg: 'https://www.nicepng.com/png/detail/242-2421384_may-pokemon-trainer-and-pokemon-girl-image-may.png',
        userToken: localStorage.getItem('userToken'),
      }
    },
    mounted() {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.userToken}` 
      this.getTrainers()
    },
    methods: {
      getTrainers () {
        axios.get('/api/trainers')
        .then((res) => {
          this.trainers = res.data.users
        })
        .catch((err) => {
          console.log(err)
        })
      },
      setFullName (trainer) {
        return trainer.first_name + ' ' + trainer.last_name
      }
    }
  }
</script>
