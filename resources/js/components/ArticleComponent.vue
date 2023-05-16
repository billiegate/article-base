<template>
    <div class="col-md-4">
        <div class="card">
            <img :src="thumbnail" class="card-img-top" alt="..."/>
            <div class="card-body">
                <h5 class="card-title">{{ title }}</h5>
                <p class="card-text">{{ description }}</p>
                <a :href="`/articles/${id}`" class="btn btn-primary">view</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Article",
        props: ['thumbnail', 'title', 'description', 'comments', 'tags', 'likeCount', 'viewCount', 'id'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                thumbnail:  this.thumbnail,
                title:      this.title,
                description: this.description,
                comments:   this.comments,
                tags:       this.tags,
                likeCount:  this.likeCount,
                viewCount:  this.viewCount,
                id: this.id
            }
        }
    }
</script>
