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
         //  name = $user.userdata.firstname + " " + $user.userdata.surname;
       //  console.log({update});
      }
   });
   let Uuid = $page.params.uid;
   console.log("this is the new uid with params: " + Uuid);
   let nameV2 = "Xxxx Yyyy";

   let retrievedUerUID;
   let retrievedUserFirstname;
   let retrievedUserSurname;

   async function getPostsByID() {
      const url = "/api/getposts.php?uid=" + Uuid;
      console.log(url);
      const respons = await fetch(url);
      const allPostsData = await respons.json();
      console.log({ allPostsData });

      if (allPostsData && allPostsData.length > 0) {
         retrievedUerUID = allPostsData[0].uid;
         retrievedUserFirstname = allPostsData[0].firstname;
         retrievedUserSurname = allPostsData[0].surname;

         nameV2 = retrievedUserFirstname + " " + retrievedUserSurname;
      }
      return allPostsData;
   }
</script>

<h1>{nameV2} TALK</h1>

<section>
   <PostForm />
   {#await getPostsByID()}
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

      hr {
         margin-bottom: 16px;
         margin-top: 8px;
      }

      div {
         border-left: 2px solid green;
      }
   }
</style>
