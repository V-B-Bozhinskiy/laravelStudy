<template>
  <div>
    <div v-if='errors.length' class="alert alert-warning" role="alert">
         <span v-for='(error, idx) in errors' :key='idx'>{{error}}<br></span>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Кол-во</th>
                <th>Сумма</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for='(product, idx) in products' :key='product.id'>
                <td>{{ idx + 1 }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td class="product-buttons">
                    <button @click="cartAction('removeFrom', product.id)" class="btn btn-danger">-</button>
                    {{ product.quantity }}
                    <button @click="cartAction('addTo', product.id)" class="btn btn-success">+</button>
                </td>
                <td>{{ Number(product.price * product.quantity).toFixed(2) }}</td>
            </tr>
            <tr v-if='!products.length'>
                <td class="text-center" colspan="5">
                        Корзина пока пустая. <a href="/">В каталог</a>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-end">Итого:</td>
                <td>
                    <strong>
                    {{ Number(summ).toFixed(2) }}
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
    <div v-if='products.length'>
    <input placeholder="Имя" class="form-control mb-2" name="name" v-model="cardName">
    <input placeholder="email" class="form-control mb-2" name="email" v-model="cardEmail">
    <input placeholder="Адрес" class="form-control mb-2" name="address" v-model="cardAddress">
    <h5>Оформляя заказ нажимая на кнопку "Оформить заказ", вы даете согласие на обработку своих персональных данных согласно <a href="TEST">документам и соглашениям по обработке персональных данных</a> и даёте своё согласие на автоматическую регистрацию себя как пользователя нашего интернет-магазина по предоставленным данным.</h5>
    <button v-if='loading' class="btn btn-success" type="button" disabled>
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Оформляем заказ...
    </button>
    <button v-else @click='createOrder' type="submit" class="btn btn-success">Оформить заказ</button>
    </div>
  </div>
</template>

<script>
export default {
    props: ['prods', 'user', 'address'],
    data () {
        return {
            products: this.prods,
            errors: [],
            loading: false,
            cardName: (this.user) ? this.user.name : '',
            cardEmail: (this.user) ? this.user.email : '',
            cardAddress: this.address
        }
    },
    computed:{
        summ(){
            return this.products.reduce((sum,product) => {
                return sum += product.price * product.quantity
            }, 0)
        }
    },
    methods:{
        cartAction (type, id) {
            const params = {
                id
            }
            axios.post(`/cart/${type}Cart`, params)
                .then(response => {
                    const index = this.products.findIndex((product) => {
                        return product.id == id
                    })
                    if (response.data > 0){
                        this.products[index].quantity = response.data
                    } else {
                        this.products.splice(index,1)
                    }
                })
        },
        createOrder(){
            const params ={
                name: this.cardName,
                email: this.cardEmail,
                address: this.cardAddress
            }
            this.loading = true
            this.errors = []
            axios.post('/cart/createOrder', params)
                .then(response => {
                    console.log(response)
                    document.location.href = `/profile/${response.data}/orders` 
                })
                .catch(error => {
                    console.log(error)
                    const errors = error.response.data.errors
                    for (let err in errors){
                        console.log(err,errors[err])
                        errors[err].forEach(e => {
                            this.errors.push(e)
                        })
                    }
                })
                .finally(()=>{
                    this.loading = false
                })
        }
    }
}
</script>

<style>

</style>