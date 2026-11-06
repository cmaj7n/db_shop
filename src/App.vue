<template>
  <div>
<!--แสดงเมนู-->
  <Navbar />

   
<!--แสดงหน้าเพจ-->
   <router-view/>
  </div>

</template>


<script>
import Navbar from "./views/navbar.vue";

export default {
  name: "App",
  components: { Navbar }
};

</script>