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
   let uid = $page.params.uid;
   console.log("this is the new uid with params: "+uid);
   let name = "Xxxx Yyyy";
</script>

<h1>{name} TALK</h1>

<section>
   <!-- Rendera flödet från användare med [uid] -->
   <PostForm />

   <!--
    <Post />

   <CommentForm />

   <Comment />

   -->
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
