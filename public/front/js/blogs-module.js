import { request } from './utils.js';

class BlogsManager {
    constructor() {
        this.Limit = 20

        this.getingBlogsLoader = document.querySelector(".BlogLoader")

        this.blogs_container = document.querySelector(".blogs-card")
        if(this.blogs_container)
        {
            this.display_blogs()
        }

        this.get_blogs_working = false
    }

    async display_blogs() {
        window.addEventListener('scroll', async () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && !this.get_blogs_working) {
                await this.get_blogs()
            }
        });
    }

    async get_blogs()
    {
        this.get_blogs_working = true
        this.getingBlogsLoader.style.display = "flex"
        let url = `/blogs/${LastBlogId}/${this.Limit}`

        const result = await request(url)

        if(result.success)
        {
            LastBlogId = result.data.last_blog_id
            this.getingBlogsLoader.insertAdjacentHTML('beforebegin', result.data.content)
            this.getingBlogsLoader.style.display = "none"
            this.get_blogs_working = false
        }
        else
        {

            this.getingBlogsLoader.innerHTML = `<p class="fw-bold mb-0 fs-5">لا يوجد نتائج اخرى</p>`
        }
    }
}

export default new BlogsManager();