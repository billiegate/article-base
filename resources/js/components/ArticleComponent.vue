<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
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
