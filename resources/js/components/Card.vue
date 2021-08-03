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
      <div v-if="cardType === 'pokemon'">
        <b-card-sub-title class="mb-2">Pokemon Type</b-card-sub-title>
        <b-card-text>
          <ul>
            <li v-for="type in pokemonType">{{ formatText(type.type.name) }}</li>
          </ul>
        </b-card-text>
      </div>
      <div v-else>
        <b-card-sub-title class="mb-2">Name: {{ userFullName }}</b-card-sub-title>
        <b-card-text>
          <span>Gotta catch em' all!</span><br />
          <span>My birthday is on: <b>{{ formatDate(birthday) }}</b></span>
        </b-card-text>
      </div>
    </template>
    <template #footer>
      <div v-show="isPokemonCard || cardType === 'personal'">
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
          <div v-if="isLiked === 1 || isDisliked === 1">
            <b-button variant="warning">
              Remove Pokemon
            </b-button>
          </div>
          <div v-else>
            <b-button href="#" variant="primary">
              <b-icon icon="hand-thumbs-up" />
            </b-button>
            <b-button href="#" variant="danger">
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
      default: 'pokemon'
    },
    isOwnProfile: {
      type: Boolean,
      default: false
    },
    userFullName: {
      type: String,
      default: ''
    }
  },
  data () {
    return {
      isLiked: 0,
      isDisliked: 0
    }
  },
  methods: {
    showModal() {
      this.$root.$emit('bv::show::modal', 'edit-modal', '#btnShow')
    },
    isPokemonCard () {
      return this.cardType ==='pokemon'
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
