<template>
  <div>
      ({{cartCounter}})
  </div>
</template>

<script>
export default {
    props: ['counter'],
    computed:{
        cartCounter(){
            return this.localStorage.cardProductsQuantity            
        }
    },
    methods:{
        cardCounterChange(count){
            console.log(`В VUE отоборажение счетчика корзины пришло ${count}`)
            this.cartCounter = count
        }
    }
}
</script>

<style>

</style>