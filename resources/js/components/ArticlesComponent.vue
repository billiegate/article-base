<template>
    <div class="container">
        {{ articles }}
        <div v-for="(article, i) in articles" :key="i" >
            <article-component 
                title="{{ article.title }}" 
                description="{{ article.description }}" 
                thumbnail="{{ article.thumbnail }}" 
                comments="{{ article.comments }}" 
                tags="{{ article.tags }}" 
                likeCount="{{ article.likeCount }}" 
                viewCount="{{ article.viewCount }}" 
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Articles",
        props: ['data'],
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
