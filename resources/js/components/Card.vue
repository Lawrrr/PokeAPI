<template>
  <b-card
    :img-src="sprite"
    :img-alt="name + '_image'"
    :img-height="200"
    border-variant="info"
    img-top
    tag="article"
    style="max-width: 20rem;"
    class="mb-2 h-100"
  >
    <template #header>
      <h4 class="mb-0">{{ formatPokemonText(name) }}</h4>
    </template>
    <template .body>
      <div>
        <b-card-sub-title class="mb-2">Pokemon Type</b-card-sub-title>
        <b-card-text>
          <ul>
            <li v-for="type in types">{{ formatPokemonText(type.type.name) }}</li>
          </ul>
        </b-card-text>
      </div>
    </template>
    <template #footer>
      <div class="text-center">
        <b-button href="#" variant="primary">
          <b-icon icon="hand-thumbs-up" />
        </b-button>
        <b-button href="#" variant="danger">
          <b-icon icon="hand-thumbs-down" />
        </b-button>
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
    sprite: {
      type: String,
      default: ''
    },
    types: {
      type: Array,
      default: []
    }
  },
  methods: {
    formatPokemonText (val) {
      return val.charAt(0).toUpperCase() + val.slice(1)
    }
  }
}
</script>
