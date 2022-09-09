
<template>





    <form  @submit.prevent="formSubmit"    enctype="multipart/form-data">
      


<input type="file" v-on:change="onChange" >

      <input type="submit"   value="Login Data"   >
    </form>
</template>

<script>
    export default {
        data() {
            return {
          
                image: '',
                title : ''
            };
        },
        methods: {
            onChange(e) {
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let data = new FormData();
                data.append('image', this.file);
                axios.post('http://localhost:8000/api/add', data, config)
                    .then(function (res) {
                        existingObj.success = res.data.success;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            }
        }
    }
</script>