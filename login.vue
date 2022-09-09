
<template>
    <div>
        <h3 class="text-center">All Potysts</h3><br/>
 
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
       
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.id }}</td>
                <td>{{ post.title }}</td>
                <td>{{ post.description }}</td>
                <td>{{ post.image }}</td>
                 <td><img   :src="'image2/' + post.image"></td>


                <td>
                    <div class="btn-group" role="group">
                  <button class="btn btn-danger" @click="deletePost(post.id)">Edit</button>


                        <button class="btn btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                </td>
            </tr>

            <pagination :data="posts" @pagination-change-page="getResults" ></pagination>
            </tbody>
        </table>
    </div>




<pagination :data="posts">
    <template #prev-nav>
        <span>&lt; Previous</span>
    </template>
    <template #next-nav>
        <span>Next &gt;</span>
    </template>
</pagination>
</template>



<script>
    export default {
        data() {
            return {
                posts: {},
                title:'',
                description: '',
                image : ''

            }
        },
        mounted(){
console.log('Component Mounted')
        },
        created(page = 1) {
            axios.get('http://localhost:8000/api/posts?page=' + page)
                .then(response => {
                  console.log(response.data)
                    this.posts = response.data;
                });

        },






             methods: {
            deletePost(id) {
            axios.delete(`http://localhost:8000/api/delete/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); 
                        this.posts.splice(i, 1)
                    });
            },

              updatePost(id) {
            axios.delete(`http://localhost:8000/api/edit/${id}`)
                    .then(response => {
                        let i = this.posts.map(item => item.id).indexOf(id); 
                        this.posts.splice(i, 1)
                    });
            }
        }


    }
</script>




