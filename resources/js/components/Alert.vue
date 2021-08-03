<template>
  <b-alert
    :show="displayAlert"
    :variant="type"
    dismissible
    @dismissed="closeAlert"
  >
    <p>{{ message }}</p>
  </b-alert>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    message: {
      type: String,
      default: 'Test message here'
    },
    type: {
      type: String,
      default: 'primary'
    },
    displayAlert: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    closeAlert() {
      this.$emit('closeAlert')
    }
  }
}
</script>
