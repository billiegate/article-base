<template>
    <div class="container">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ title }}</div>

                <div class="card-body">
                    <div>{{ description }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Article",
        props: ['thumbnail', 'title', 'description', 'comments', 'tags', 'likeCount', 'viewCount'],
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
                viewCount:  this.viewCount
            }
        }
    }
</script>
