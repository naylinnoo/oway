<template>
    <div>
        <div class="d-flex justify-content-center mb-3">
            <img :src="'/storage/'+this.path"
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
            file: null
        }
    },
    methods: {
        updatePhoto(event) {
            this.file = event.target.files[0]
            const formData = new FormData();
            formData.append('image', this.file, this.file.name)

            axios.post('/profile/update/photo', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.path = response.data
                })
        },
    }

}
</script>
