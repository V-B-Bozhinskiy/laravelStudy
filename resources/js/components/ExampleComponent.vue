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
                    <td>
                        <a :href="`/category/${category.id}`">
                        {{category.name}}  ({{category.id}})
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <button @click="addCategory" class="btn btn-primary">Добавить категорию</button>
        <br>
        {{ fullname }}
        <br>
        <input v-model="inputText" @input="listenInput" class="form-control">
        <br>
        <input v-model="name" class="form-control">
        <br>
        <input v-model="text" class="form-control">
        <br>
        {{reversedText}} <!-- computed кешируется (пересчитывается только при изменении, без изменения вызывается из кеша) -->
        <br>
        {{ reverseText() }} <!-- Метод каждый раз (при каждом вызове) пересчитывается -->
        <select v-model="selected" class="form-control mb-5">
            <option :value='null' selected disabled>-- Выберите значение --</option>
            <option v-for="(option, idx) in options" :value="option" :key='idx'>
                {{ option }}
            </option>
        </select>
       <!-- <button :disabled="!selected" class="btn mt-5" :class="{'btn-primary' : selected }">SAVE</button> -->
       <button :disabled="!selected" class="btn mt-5" :class="buttonClass">SAVE</button>
        <br>
        <button @click='getData' class="btn btn-info">Получить данные</button>
        <table class="table table-bordered">
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                </tr>
                <tr v-if="!users.length">
                    <td class="text-center" colspan="3">
                        <em>
                            Данные пока не получены
                        </em>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                inputText: '',
                text: '',
                name: 'Vyacheslav',
                lastname: 'Bozhko-Bozhinskiy',
                counter: 0,
                selected: null,
                options:[1,2,3],
                users:[],
                showPicture: true,
                categories: [
                    {
                        id: 5,
                        name: 'Видеокарты'
                    },
                    {
                        id: 6,
                        name: 'Процессоры'
                    },
                    {
                        id: 7,
                        name: 'SSD/HDD'
                    }
                ]
            }
        },
        computed:{
            fullname(){
                return this.name+' '+this.lastname
            },
            reversedText(){
                return this.text.split('').reverse().join('')
            },
            buttonClass(){
                return this.selected ? 'btn-success' : 'btn-primary'
            }
        },
        watch:{
            selected: function(newValue, oldValue){
                console.log(`новое значение: ${newValue}, старое - ${oldValue}`)
            }
        },
        methods:{
            getData(){
                const params = {
                    id: 1
                }
                axios.get('/api/test', {params})  // указание params для get через {{}} 
                //axios.post('/api/test', params) // указание params для post не требует {{}}
                    .then(response => {
                        this.users = response.data
                    })
            },
            reverseText(){
                return this.text.split('').reverse().join('')
            },
            addCategory(){
                this.categories.push({
                    id: 8,
                    name: 'ОЗУ'
                })
            },
            counterPlus(){
                this.counter += 1
            },
            listenInput(){
                console.log('Пользователь ввел '+this.inputText)
            }
        },
        mounted() {
            console.log('Example Component mounted.')
        }
    }
</script>

<style scoped>

</style>