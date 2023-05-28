<script>
   /**
    * Data som kommer in i komponenten
    * <Post post = {...} />
    */
   export let post;
</script>

<article>
   <h2> post:{post.pid}, {post.firstname} {post.surname}, {post.date}</h2>
   <br>
   <p>{post.post_txt}</p>
   <br>
   <p>{post.date}</p>
</article>

<style lang="scss">
   article {
      border-bottom: 1px solid black;
      display: block;
      width: 100%;
      padding: 4px;
      margin-top: 6px;
      margin-bottom: 6px;
      background-color: white;
      border-left: 5px solid red;

      p {
         font-size: 1.6rem;
      }
   }
</style>
