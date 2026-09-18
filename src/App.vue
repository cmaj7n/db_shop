<template>
<nav class="navbar">
  <div class="nav-container">
    <ul class="nav-links">
      <li><router-link to="/">Home</router-link></li>
      <li><router-link to="/about">About</router-link></li>
      <li><router-link to="/customer">Customer</router-link></li>
      <li><router-link to="/employee">Employee</router-link></li>
      <li><router-link to="/contact">Contact</router-link></li>
    </ul>
  </div>
</nav>
  <router-view/>
</template>

<script>
export default {
  name: 'StyleNavbar'
}
</script>

<style scoped>
.navbar {
  background-color: #1a1d20; /* สีดำเข้มสไตล์ดาร์กโมเดิร์น */
  width: 100%;
  padding: 1rem 2rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav-links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 2rem;
  width: 100%;
  justify-content: flex-end; /* ดันเมนูทั้งหมดไปชิดขวาตามเรฟ */
}

.nav-links a {
  color: #9ca3af; /* สีเทานุ่มๆ สำหรับลิงก์ปกติ */
  text-decoration: none;
  font-size: 0.95rem;
  font-weight: 500;
  transition: color 0.2s ease;
}

.nav-links a:hover,
.nav-links a.router-link-active {
  color: #ffffff; /* เปลี่ยนเป็นสีขาวเมื่อชี้หรือเลือกหน้านั้นๆ */
}

/* สไตล์ปุ่มสีฟ้าเด่นๆ (เทียบเท่าปุ่ม Contact ในภาพเรฟ) */
.nav-links a.nav-btn {
  background-color: #0093ad; /* สีฟ้าเข้มอมเขียวแบบในภาพเรฟ */
  color: #ffffff;
  padding: 0.5rem 1.25rem;
  border-radius: 50px;
  transition: background-color 0.2s ease, box-shadow 0.2s ease;
}

.nav-links a.nav-btn:hover,
.nav-links a.nav-btn.router-link-active {
  background-color: #00b4d8; /* ฟ้าสว่างขึ้นตอนชี้ */
  color: #ffffff;
  box-shadow: 0 0 12px rgba(0, 180, 216, 0.4);
}
</style>