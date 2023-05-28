<script>
   import { page } from "$app/stores";
   import Load from "$lib/components/Load.svelte";
   import PostForm from "$lib/components/PostForm.svelte";
   import Post from "$lib/components/Post.svelte";
   import CommentForm from "$lib/components/CommentForm.svelte";
   import Comment from "$lib/components/Comment.svelte";

   import { user } from "$lib/stores/user.js";
   import { update } from "$lib/stores/update.js";
   import { goto, afterNavigate } from "$app/navigation";
   import { auth } from "$lib/shared/auth.js";

   afterNavigate(async () => {
      $user = await auth();

      if (!$user.auth) {
         goto("/login");
      } else {
         name = $user.userdata.firstname + " " + $user.userdata.surname;
         let userUid = $user.userdata.uid;
         console.log("this log is from [uid] from flow");
         console.log({ userUid });
      }
   });
   let Uuid = $page.params.uid;
   console.log("this is the new uid with params: "+Uuid);
   let name = "Xxxx Yyyy";


   async function getPostsByID() {
      const url = "/api/getposts.php?uid="+Uuid;
      console.log(url);
      const respons = await fetch(url);
      const allPostsData = await respons.json();
    //  console.log({allPostsData});
      return allPostsData;
   }
</script>

<h1>{name} TALK</h1>

<section>
   <PostForm />
   <!--  (1) Postform, (2) Post , (3) comments-->

   {#await getPostsByID() then allPostsData}
      {#each allPostsData as SinglePost}
         <Post post={SinglePost} />
         
         <CommentForm postID={SinglePost.pid} />
         <h2>this is it!! {SinglePost.pid}</h2>
         {#each SinglePost.comments as SingleComment}
          <Comment comment={SingleComment} />
         {/each}
         <hr>
      {/each}
   {/await}

</section>

<style lang="scss">
   section {
      max-width: 540px;

      hr {
         margin-bottom: 16px;
         margin-top: 8px;
      }

      div {
         border-left: 2px solid green;
      }
   }
</style>
