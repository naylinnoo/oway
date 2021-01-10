<template>
    <div>
        <div v-if="this.message" class="alert alert-primary" role="alert">
           {{this.message}}
        </div>
        <div class="d-flex justify-content-center mb-3">
            <img :src="this.path ? '/storage/'+this.path : '#'"
                 class="img-thumbnail rounded mx-auto d-block"
                 width="100" height="100"
            >
            <input type="file" id="file" ref="file" @change="updatePhoto($event)" style="display: none"/>

        </div>
        <div class="d-flex justify-content-center mb-5">
            <button @click="$refs.file.click()" class="btn btn-primary">Update Image</button>
        </div>
    </div>

</template>

<script>

export default {
    mounted() {
        console.log('Component mounted.')
    },
    props: ['src'],
    data() {
        return {
            path: this.src,
            file: null,
            message: null,
        }
    },
    methods: {
        updatePhoto(event) {
            this.file = event.target.files[0]
            const formData = new FormData();
            formData.append('image', this.file)

            axios.post('/profile/update/photo', formData)
                .then(response => {
                    if(response.data.status === 'success'){
                        this.path = response.data.photo
                        this.message = "Photo successfully uploaded"
                    }else{
                        this.message = response.data.status.image[0]
                    }
                })
                .catch(function (error) {
                })
        },
    }

}
</script>
