<template>
    <div class="container">
        <div v-if="articles.length === 0">
            No article at the moment create one
        </div>
        <div class="row">
            <article-component
                v-for="(article, i) in articles" :key="i"
                :title="article.title" 
                :description="article.description" 
                :thumbnail="article.thumbnail" 
                :comments="article.comments" 
                :tags="article.tags" 
                :likeCount="article.likeCount" 
                :viewCount="article.viewCount" 
                :id="article.id"
            />
        </div>
    </div>
</template>

<script>
    import ArticleComponent from './ArticleComponent.vue';

    export default {
        name: "Articles",
        props: ['data'],
        components: {
            'article-component': ArticleComponent
        },
        mounted() {
            const {status = 200, data: responseData = [], message = ""} = JSON.parse(this.data)
            const {data = [], current_page, first_page_url, last_page, per_page} = responseData
            this.articles = data
        },
        data() {
            return {
                articles: []
            }
        }
    }
</script>
