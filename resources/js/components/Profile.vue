<template>
  <div class="container row mt-5">
    <div class="col-md-12">
      <Alert 
        :displayAlert="displayAlert"
        :message="alertMessage"
        :type="'success'"
        @closeAlert="closeAlert"
      />
    </div>
    <div class="col-md-3">
      <Card
        :name="userData.username"
        :userFullName="fullName"
        :image="userData.image"
        :types="testCardData[0].types"
        :isOwnProfile="true"
        :cardType="'personal'"
        :birthday="userData.date_of_birth"
        @showModal
      />
    </div>
    <div class="col-md-9">
      <h3>Liked</h3>
      <div class="row mb-3">
        
        <div 
          v-for="pokemon in testCardData"
          class="col-md-4"
        >
          <Card
            :name="pokemon.name"
            :image="pokemon.sprite"
            :pokemonType="pokemon.types"
            :setHeight="true"
          />
        </div>
      </div>
      <h3>Disliked</h3>
      <div class="row mb-5">
        <div 
          v-for="pokemon in testCardData"
          class="col-md-4"
        >
          <Card
            :name="pokemon.name"
            :image="pokemon.sprite"
            :pokemonType="pokemon.types"
            :setHeight="true"
          />
        </div>
      </div>
    </div>
    <!-- Edit Profile Modal -->
    <div>
      <b-modal 
        v-model="showModal"
        id="edit-modal" 
        title="Edit Profile"
        hide-footer
        no-close-on-backdrop
      >
        <div class="edit-form">
          <b-form v-on:submit.prevent="editUser">
            <b-form-group>
              <label for="first_name">First Name</label>
              <b-form-input 
                v-model="userData.first_name" 
                class="form-control" 
                name="first_name" 
                placeholder="Enter your first name..."
                required
              />
            </b-form-group>

            <b-form-group>
              <label for="last_name">Last Name</label>
              <b-form-input 
                v-model="userData.last_name" 
                class="form-control" 
                name="last_name" 
                placeholder="Enter your last name..."
                required
              />
            </b-form-group>

            <b-form-group>
              <label for="date_of_birth">Birth Date</label><br />
                <date-picker 
                  v-model="userData.date_of_birth"
                  value-type="format"
                  format="YYYY-MM-DD"
                  placeholder="Select Date"
                  required
                ></date-picker>
            </b-form-group>
            <div class="float-right">
              <b-button 
                type="submit"
                variant="warning"
              >
                Update Profile
              </b-button>
            </div>
          </b-form>
        </div>
      </b-modal>
    </div>
  </div>
</template>

<script>
  import Card from './Card.vue'
  import Alert from './Alert.vue'
  import DatePicker from 'vue2-datepicker'

  export default {
    name: 'Profile',
    components: {
      Card,
      DatePicker,
      Alert
    },
    data () {
      return {
        userData: {
          username : '',
          first_name: '',
          last_name: '',
          date_of_birth: '',
          image: 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/33a43285-a481-406e-a6a2-dfde98a9359b/dawqtd5-ab0a2edd-2200-4899-9dae-84095a9bba05.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzMzYTQzMjg1LWE0ODEtNDA2ZS1hNmEyLWRmZGU5OGE5MzU5YlwvZGF3cXRkNS1hYjBhMmVkZC0yMjAwLTQ4OTktOWRhZS04NDA5NWE5YmJhMDUucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.iRxT6vkCTmmQXvjBhpjDJoCjS_U1EaFVqJbHsN_Uj2s'
        },
        fullName: '',
        showModal: false,
        userToken: localStorage.getItem('userToken'),
        alertMessage: '',
        displayAlert: false,
        testCardData: [
          {
            "name":"weedle",
            "sprite":"https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png",
            "types":[
              {"slot":1,"type":{"name":"bug","url":"https://pokeapi.co/api/v2/type/7/"}},
              {"slot":2,"type":{"name":"poison","url":"https://pokeapi.co/api/v2/type/4/"}}
            ]
          },
          {
            "name":"weedle",
            "sprite":"https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png",
            "types":[
              {"slot":1,"type":{"name":"bug","url":"https://pokeapi.co/api/v2/type/7/"}},
              {"slot":2,"type":{"name":"poison","url":"https://pokeapi.co/api/v2/type/4/"}}
            ]
          },
          {
            "name":"weedle",
            "sprite":"https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/13.png",
            "types":[
              {"slot":1,"type":{"name":"bug","url":"https://pokeapi.co/api/v2/type/7/"}},
              {"slot":2,"type":{"name":"poison","url":"https://pokeapi.co/api/v2/type/4/"}}
            ]
          },
        ]
      }
    },
    created () {
      // axios.defaults.headers.common['Authorization'] = `Bearer ${this.userToken}`
    },
    mounted () {
      this.getUserData();
    },
    methods: {
      closeAlert () {
        this.displayAlert = false
      },
      editUser () {
        axios.post('/api/user/profile/update', this.userData)
        .then((res) => {
          this.getUserData()
          this.alertMessage = res.data.message
        })
        .catch((err) => {
          console.log(err)
        })
        .finally(() => {
          this.showModal = false
          this.displayAlert = true
        })
      },
      getUserData () {
        axios.get('/api/user/profile/get')
        .then((res) => {
          let user = res.data.user
          this.userData.username = user.username
          this.userData.first_name = user.first_name
          this.userData.last_name = user.last_name
          this.userData.date_of_birth = user.date_of_birth
          this.fullName = user.first_name + ' ' + user.last_name
        })
        .catch((err) => {
          console.log(err)
        })
      }
    }
  }
</script>
