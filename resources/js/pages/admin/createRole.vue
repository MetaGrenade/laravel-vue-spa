<template>
    <div >
        <form @submit.prevent="submitRole">
            <div class="form-group">
                <label for="name">Role Name:</label>
                <input type="text" v-model="title" name="name" class="form-control" id="name">
                <span class="text text-danger" v-if="errors.title">{{errors.title[0]}}</span>
            </div>
            <div class="form-group">
                <label for="slug">Role Slug:</label>
                <input type="text" v-model="slug" class="form-control" id="slug">
                <span class="text text-danger" v-if="errors.slug">{{errors.slug[0]}}</span>
            </div>
            <div class="form-group">
                <label for="pwd">Role Icon:</label>
                <input type="text" v-model="icon" class="form-control" id="pwd">
                <span class="text text-danger" v-if="errors.icon">{{errors.icon[0]}}</span>
            </div>
            <div class="form-group">
                <label for="color">Role Color:</label>
                <input type="text" v-model="color" class="form-control" id="color">
                <span class="text text-danger" v-if="errors.color">{{errors.color[0]}}</span>
            </div>
            <div class="form-group">
                <label for="description">Role Description:</label>
                <textarea v-model="description" class="form-control" rows="5" id="description"></textarea>
                <span class="text text-danger" v-if="errors.description">{{errors.description[0]}}</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
  //  import { mapGetters } from 'vuex'
  import axios from 'axios';
    export default {
        data(){
            return{
              title:'',
              color:'',
              description:'',
              slug:'',
              icon:'',
                errors:[]
            }
        },
        methods:{
            submitRole(){
               axios.post('/api/v1/role-management/role',{
                   title:this.title,
                   color:this.color,
                   description:this.description,
                   icon:this.icon,
                   slug:this.slug
               }).then(response=>{
                   if(response.status==200){
                       this.errors=[];
                       this.title='';
                       this.color='';
                       this.slug='';
                       this.description='';
                       this.icon='';
                       this.$alertify.success('success');
                       this.$router.push('/admin/roles');
                   }
               }).catch(error=>{
                   this.errors=error.response.data.errors;
               });
            }
        }
    }

</script>
