<template>
  <div v-if='loading' class="spinner-border text-info" role="status">
        <span class="visually-hidden">Loading...</span>
  </div>
  <div v-else>
      <template v-if='errors'>
          <div class='alert alert-danger'>
              <div v-for='(error, idx) in errors' :key='idx' class='errors'>
                  <p v-for='(e,i) in error' :key='i'>{{e}}</p>
              </div>
          </div> 
      </template>
    <div class="mb-3">
        <label class="form-label">Изображение</label>
        <image class="user-picture mb-2" :src="user.picture"/>
        <input type="file" name="picture" class="form-control">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input v-model='user.email' type="email" class="form-control" name="email" aria-describedby="emailHelp">
        <div class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Имя</label>
        <input v-model='user.name' class="form-control">
    </div>
    
    <div class="mb-3">
        <label class="form-lable">Текущий пароль</label>
        <input v-model='current_password' type="password" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-lable">Новый пароль</label>
        <input v-model='password' type="password" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-lable">Повторите новый пароль</label>
        <input v-model='password_confirmation' type="password" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Адрес</label>
        <input v-model='new_address' class="form-control" >
    </div>
    
    <button @click='save' class="btn btn-primary">Сохранить</button>

    <div class="mb-3">
        <label class="form-label">Список сохраненных адресов:</label>
        <div v-for='address in user.addresses' :key="address.id">
            <label :for="`main_address${address.id}`">{{address.address}}</label>
            <input :checked='address.main' :id="`main_address${address.id}`" type="radio">
        </div>
        <span v-if='!user.addresses'>
            Адресов пока нет.
        </span>
    </div>
  </div>
</template>

<script>
export default {
    data () {
        return {
            loading: true,
            user: null,
            new_address: null,
            password: null,
            current_password: null,
            password_confirmation: null,
            errors: null
        }
    },
    methods: {
        save(){
            this.errors = null
            const params ={
                name: this.user.name,
                email: this.user.email,
                userId: this.user.id
            }
            axios.post('/api/profile/save', params)
                .then(()=>{
                    alert('SAVED!')
                })
                .catch((error) => {
                   this.errors = error.response.data.errors
                })
        }
    },
    mounted (){
        axios.get('/api/user')
            .then((response) => {
                this.user = response.data.user
                this.loading = false
                console.log(this.user)
            })
    }
}
</script>

<style scoped>
        .user-picture{
        width: 100px;
        border-radius: 100px;
        display: block;
    }
    .main-address{
        font-weight: bold;
    }
    .address-buttons{
        display: flex;
        justify-content: flex-start;
        line-height: 37px;
    }
    .btn-addr-setMain {
    border-radius: 100px;
    margin-left: 10px;
    margin-right: 10px;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 0px;
    padding-top: 0px;
    }

    .btn-addr-delete {
    border-radius: 100px;
    margin-left: 10px;
    margin-right: 10px;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 0px;
    padding-top: 0px;
    }

    .errors{
        padding: 10px 18px 0px;
    }
</style>