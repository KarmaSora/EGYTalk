<script>
   import Load from "$lib/components/Load.svelte";
   import PostForm from "$lib/components/PostForm.svelte";
   import Post from "$lib/components/Post.svelte";
   import CommentForm from "$lib/components/CommentForm.svelte";
   import Comment from "$lib/components/Comment.svelte";

   import { user } from "$lib/stores/user.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth.js";

   afterNavigate(async () => {
      $user = await auth();
      if (!$user.auth) {
         goto("/login");
      }
   });

   async function getPosts() {
      const url = "/api/getallposts.php";
      const respons = await fetch(url);
      const allPostsData = await respons.json();
      //  console.log({allPostsData});
      return allPostsData;
   }
</script>

<section>
   <h1>EveryOnes Flow</h1>
   <!-- Rendera flödet  -->

   <PostForm />
   {#await getPosts()}
      <Load />
   {:then allPostsData}
      {#each allPostsData as SinglePost}
         <Post post={SinglePost} />

         <CommentForm postID={SinglePost.pid} />
         <h2>this is it!! {SinglePost.pid}</h2>
         {#each SinglePost.comments as SingleComment}
            <Comment comment={SingleComment} />
         {/each}
         <hr />
      {/each}
   {/await}
</section>

<style lang="scss">
   section {
      max-width: 540px;
      margin-bottom: 15rem;

      hr {
         margin-bottom: 16px;
         margin-top: 8px;
      }

      div {
         border-left: 2px solid green;
      }
   }
</style>
