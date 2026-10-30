<template>
  <div class="home-container">
    <!-- Hero Section -->
    <section class="hero-section">
      <div class="glow-effect"></div>
      <div class="hero-content">
        <span class="badge">Vue.js Dashboard Project</span>
        <h1 class="hero-title">
          ยินดีต้อนรับสู่ระบบ <span class="gradient-text">Management System</span>
        </h1>
        <p class="hero-subtitle">
          ระบบจัดการข้อมูลลูกค้าและพนักงานที่ออกแบบมาเพื่อความรวดเร็วและเป็นระเบียบ
        </p>
        <div class="hero-actions">
          <router-link to="/customer" class="btn btn-primary">จัดการข้อมูล Customer</router-link>
          <router-link to="/employee" class="btn btn-secondary">จัดการข้อมูล Employee</router-link>
        </div>
      </div>
    </section>

    <!-- Cards Section -->
    <section class="features-section">
      <div class="card">
        <div class="icon-box blue">👥</div>
        <h3>Customers</h3>
        <p>ดูรายชื่อ ตรวจสอบสถานะ และจัดการระบบข้อมูลลูกค้าทั้งหมดในระบบ</p>
        <router-link to="/customer" class="card-link">ไปหน้า Customer &rarr;</router-link>
      </div>

      <div class="card">
        <div class="icon-box cyan">💼</div>
        <h3>Employees</h3>
        <p>บริหารจัดการรายชื่อพนักงาน ข้อมูลตำแหน่ง และรายละเอียดส่วนตัว</p>
        <router-link to="/employee" class="card-link">ไปหน้า Employee &rarr;</router-link>
      </div>

      <div class="card">
        <div class="icon-box purple">ℹ️</div>
        <h3>About System</h3>
        <p>อ่านข้อมูลเพิ่มเติมเกี่ยวกับระบบ เทคโนโลยีที่ใช้ และรายละเอียดอื่นๆ</p>
        <router-link to="/about" class="card-link">ไปหน้า About &rarr;</router-link>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'HomeView'
}
</script>

<style scoped>
.home-container {
  min-height: calc(100vh - 70px);
  background-color: #0f172a; /* โทนดาร์กสไตล์ Tailwind Slate-900 */
  color: #f8fafc;
  padding: 3rem 1.5rem;
  font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
  position: relative;
  overflow: hidden;
}

/* Glow Background Effect */
.glow-effect {
  position: absolute;
  top: -100px;
  left: 50%;
  transform: translateX(-50%);
  width: 600px;
  height: 300px;
  background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(37, 99, 235, 0.05) 60%, transparent 100%);
  filter: blur(50px);
  pointer-events: none;
}

/* Hero Section */
.hero-section {
  max-width: 900px;
  margin: 0 auto 4rem auto;
  text-align: center;
  position: relative;
  z-index: 1;
}

.badge {
  display: inline-block;
  background-color: rgba(56, 189, 248, 0.1);
  color: #38bdf8;
  border: 1px solid rgba(56, 189, 248, 0.2);
  padding: 0.35rem 1rem;
  border-radius: 9999px;
  font-size: 0.85rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
}

.hero-title {
  font-size: 3rem;
  font-weight: 800;
  line-height: 1.2;
  letter-spacing: -0.025em;
  margin-bottom: 1.25rem;
}

.gradient-text {
  background: linear-gradient(135deg, #38bdf8, #818cf8);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.hero-subtitle {
  font-size: 1.125rem;
  color: #94a3b8;
  max-width: 650px;
  margin: 0 auto 2rem auto;
  line-height: 1.6;
}

.hero-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
}

.btn {
  padding: 0.75rem 1.75rem;
  border-radius: 0.5rem;
  font-weight: 600;
  text-decoration: none;
  font-size: 0.95rem;
  transition: all 0.2s ease;
}

.btn-primary {
  background-color: #0284c7;
  color: #ffffff;
  box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
}

.btn-primary:hover {
  background-color: #0369a1;
  transform: translateY(-1px);
}

.btn-secondary {
  background-color: #1e293b;
  color: #e2e8f0;
  border: 1px solid #334155;
}

.btn-secondary:hover {
  background-color: #334155;
  color: #ffffff;
}

/* Feature Cards Section */
.features-section {
  max-width: 1100px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

.card {
  background-color: #1e293b;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 0.75rem;
  padding: 1.75rem;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
}

.card:hover {
  transform: translateY(-4px);
  border-color: rgba(56, 189, 248, 0.3);
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
}

.icon-box {
  width: 48px;
  height: 48px;
  border-radius: 0.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  margin-bottom: 1.25rem;
}

.icon-box.blue { background-color: rgba(2, 132, 199, 0.15); }
.icon-box.cyan { background-color: rgba(6, 182, 212, 0.15); }
.icon-box.purple { background-color: rgba(139, 92, 246, 0.15); }

.card h3 {
  font-size: 1.25rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: #f8fafc;
}

.card p {
  color: #94a3b8;
  font-size: 0.9rem;
  line-height: 1.5;
  margin-bottom: 1.5rem;
  flex-grow: 1;
}

.card-link {
  color: #38bdf8;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: color 0.2s ease;
}

.card-link:hover {
  color: #7dd3fc;
}
</style>