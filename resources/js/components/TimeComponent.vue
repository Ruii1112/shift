<template>
    <vue-timepicker
        :value='value'
        :name="name"
        placeholder="時間を入力"
        hour-label="時"
        minute-label="分"
        minute-interval="30"
        advanced-keyboard
        manual-input
        auto-scroll
        @change="onChange">
    </vue-timepicker>
</template>

<script>
    import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue'
    
    export default {
        components: {
            'vue-timepicker': VueTimepicker,
        },
        props: {
            name: {
                type: String,
                default: "",
            },
            value: {
                type: String,
                default: "",
            }
        },
        methods: {
          onChange: function() {
              console.log('変更されました')
          }
      }
    }
</script>