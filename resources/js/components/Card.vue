<template>
  <b-card
    :img-src="image"
    :img-alt="name + '_image'"
    :img-height="200"
    border-variant="info"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2"
    :class="{ 'h-100': setHeight }"
  >
    <template #header>
      <div class="text-center">
        <h4 class="mb-0">{{ formatText(name) }}</h4>
      </div>
    </template>

    <template .body>
      <div v-if="cardType === 'trainer'">
        <b-card-sub-title class="mb-2">Name: {{ userFullName }}</b-card-sub-title>
        <b-card-text>
          <span>I challenge you!</span><br />
        </b-card-text>
        <slot name='trainer-pokemons'></slot>
      </div>

      <div v-else-if="cardType === 'personal'">
        <b-card-sub-title class="mb-2">Name: {{ userFullName }}</b-card-sub-title>
        <b-card-text>
          <span>Gotta catch em' all!</span><br />
          <span>My birthday is on: <b>{{ formatDate(birthday) }}</b></span>
        </b-card-text>
      </div>

      <div v-else-if="isPokemonCard">
        <b-card-sub-title class="mb-2">Pokemon Type</b-card-sub-title>
        <b-card-text>
          <p v-if="liked">
            You like this Pokemon 
            <b-icon icon="hand-thumbs-up" />
          </p>
          <p v-else-if="disliked">
            You dislike this Pokemon
            <b-icon icon="hand-thumbs-down" />
          </p>
          <p else></p>
          <ul>
            <li v-for="type in pokemonType">{{ formatText(type.type.name) }}</li>
          </ul>
        </b-card-text>
      </div>
    </template>

    <template #footer>
      <div 
        v-if="cardType === 'trainer'"
        class="text-center"
      >
        <b>Copyright 2021 PokeApi.</b>
      </div>
      <div v-else-if="isPokemonCard || cardType === 'personal'">
        <div
          v-if="isOwnProfile"
          class="text-center"
        >
          <b-button 
            variant="success"
            @click="showModal"
            ref="btnShow"
          >
            Edit Profile
          </b-button>
        </div>

        <div
          v-else
          class="text-center"
        >
          <div v-if="liked === true || disliked === true">
            <b-button 
              variant="warning"
              @click="removePokemon"
            >
              Remove Pokemon
            </b-button>
          </div>
          <div v-else>
            <b-button 
              variant="primary"
              @click="likePokemon"
            >
              <b-icon icon="hand-thumbs-up" />
            </b-button>
            <b-button 
              variant="danger"
              @click="dislikePokemon"
            >
              <b-icon icon="hand-thumbs-down" />
            </b-button>
          </div>
        </div>
      </div>
    </template>
  </b-card>
</template>

<script>
export default {
  name: 'Card',
  props: {
    name: {
      type: String,
      default: ''
    },
    image: {
      type: String,
      default: ''
    },
    pokemonType: {
      type: Array,
      default() {
        return []
      }
    },
    birthday: {
      type: String,
      default: ''
    },
    setHeight: {
      type: Boolean,
      default: false
    },
    cardType: {
      type: String,
      default: ''
    },
    isOwnProfile: {
      type: Boolean,
      default: false
    },
    userFullName: {
      type: String,
      default: ''
    },
    liked: {
      type: Boolean,
      default: false
    },
    disliked: {
      type: Boolean,
      default: false
    },
    userLikesDislikes: {
      type: Array,
      default () {
        return []
      }
    }
  },
  methods: {
    showModal() {
      this.$root.$emit('bv::show::modal', 'edit-modal', '#btnShow')
    },
    removePokemon() {
      this.$emit('removePokemon', this.name)
    },
    likePokemon() {
      this.$emit('likePokemon', this.name)
    },
    dislikePokemon() {
      this.$emit('dislikePokemon', this.name)
    },
    isPokemonCard () {
      return this.cardType === 'pokemon'
    },
    formatDate (val) {
      const months = ["January", "February", "March","April", "May", "June", "July", "August", "September", "October", "November", "December"];
      let current_datetime = new Date(val)
      let formatted_date =  months[current_datetime.getMonth()] + " " + current_datetime.getDate() + ", " + current_datetime.getFullYear()

      return formatted_date
    },
    formatText (val) {
      if (this.isPokemonCard()) {
        return val.charAt(0).toUpperCase() + val.slice(1)
      } else {
        return val
      }
    }
  }
}
</script>
