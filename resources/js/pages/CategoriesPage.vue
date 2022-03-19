<template>
  <div>

    <div class="row">
        <category-component 
            v-for="category in categories"
            :key="category.id"
            :category='category'
            @buttonClicked='buttonClicked'
            >
        </category-component>
    </div>
  </div>
</template>

<script>
import CategoryComponent from '../components/CategoryComponent.vue'
export default {
    components: {CategoryComponent},
    data(){
        return {
            categories: []
        }
    },
    //props:['test', 'pageTitle', 'categories','routeCategory'], //то что было передано с названием переменной в kebab-case станет camelCase!
    methods:{
        buttonClicked(data){
            console.log(`Клик в дочернем компоненте (${data})`)
        }
    },
    mounted (){
        axios.get('/api/getCategories')
            .then((response) => {
                this.categories = response.data
            })
        //let quantity = /\d+/.exec(cardProductsQuantity.textContent)
        //localStorage.cardProductsQuantity = quantity
    }
}
</script>

<style scoped>

</style>