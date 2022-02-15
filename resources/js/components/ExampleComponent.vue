<template>
    <div>
        Example component
        <br>
        {{ name }}
        <br>
        Counter: {{counter}}
        <button v-on:click="counterPlus" class="btn btn-info">Click</button>
        <br>
        <span v-if="counter < 10"> Значение Counter меньше 10</span>
        <span v-else-if="counter < 15"> Значение Counter меньше 15</span>
        <span v-else> Значение Counter больше или равно 15</span>
        <br>

        <button @click="showPicture = !showPicture" class="btn btn-success">Switch</button>
        <br>
        <img style="wigth: 300px" v-if="showPicture" src="https://www.cyberpunk.net/build/images/next-gen/logo-horizontal-en-8f759eab.svg">
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Категория </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <td>{{index+1}}</td>
                    <td>{{category.name}}</td>
                </tr>
            </tbody>
        </table>
        <button @click="addCategory" class="btn btn-primary">Добавить категорию</button>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                name: 'Vyacheslav',
                counter: 0,
                showPicture: true,
                categories: [
                    {
                        id: 1,
                        name: 'Видеокарты'
                    },
                    {
                        id: 2,
                        name: 'Процессоры'
                    },
                    {
                        id: 3,
                        name: 'ОЗУ'
                    }
                ]
            }
        },
        methods:{
            addCategory(){
                this.categories.push({
                    id: 4,
                    name: 'SSD/HDD'
                })
            },
            counterPlus(){
                this.counter += 1
            }
        },
        mounted() {
            console.log('Example Component mounted.')
        }
    }
</script>

<style scoped>

</style>