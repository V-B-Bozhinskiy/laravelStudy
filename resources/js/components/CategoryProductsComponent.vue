<template>
    <div class="row" :class="{'load-speener': !products.length}">
      <div v-if="!products.length" class="spinner-border text-info" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
        <product-component 
          v-else
          v-for='product in products' :key='product.id'
          :product="product"
          @cardCounterChange='cardCounterChange'>
        </product-component>
    </div>
</template>

<script>
import ProductComponent from './ProductComponent.vue'
export default {
  props: ['category'],
  components: { ProductComponent },
  methods:{
    cardCounterChange(count){
      console.log(`В страницу продуков категории пришло ${count}`)
      this.$emit('cardCounterChange',count)
    }
  },
  data (){
    return {
      products: []
    }
  },
  mounted(){
    axios.get(`/category/${this.category}/getProducts`)
      .then(response => {
        this.products = response.data
      })
  }
}
</script>

<style scoped>
  .load-speener{
    margin-top: 20%;
    justify-content: space-around;
  }

</style>