<template>
  <div class="page-container">
    <div class="content-wrapper">
      <!-- Header Section -->
      <div class="header-section">
        <div>
          <h1 class="page-title">ข้อมูลติดต่อเรา</h1>
          <p class="page-subtitle">จัดการและเรียกดูข้อมูลติดต่อเราทั้งหมดในระบบ</p>
        </div>
        <!-- ปุ่มเพิ่มข้อมูล -->
        <router-link to="/add-contact" class="btn-add">
          <span class="btn-icon">+</span> เพิ่มข้อมูล
        </router-link>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="state-box">
        <p>กำลังโหลดข้อมูล...</p>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="state-box error">
        <p>{{ error }}</p>
      </div>

      <!-- Table Container -->
      <div v-else class="table-card">
        <div class="table-responsive">
          <table class="custom-table">
            <thead>
              <tr>
                <th>ลำดับที่</th>
                <th>รหัสการติดต่อ</th>
                <th>หัวข้อ</th>
                <th>รายละเอียด</th>
                <th>ชื่อ-นามสกุล</th>
                <th>Email</th>
                <th>เวลาที่เพิ่มข้อมูล</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in customers" :key="item.customer_id || index">
                <td>{{ index + 1 }}</td>
                <td><span class="id-badge">#{{ item.contact_id }}</span></td>
                <td>{{ item.subject }}</td>   <!-- ชื่อ -->
                <td>{{ item.detail }}</td>    <!-- นามสกุล -->
                <td>{{ item.fullname }}</td>       <!-- เบอร์โทร -->
                <td><span class="username-tag">{{ item.email }}</span></td>
                <td>{{item.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'CustomerView',
  data() {
    return {
      customers: [],
      loading: true,
      error: null
    }
  },
  mounted() {
    this.fetchCustomers()
  },
  methods: {
    async fetchCustomers() {
      try {
        const response = await axios.get('http://localhost/project-ict12267/php_api/show_contact.php')
        this.customers = response.data
      } catch (err) {
        this.error = 'ไม่สามารถเชื่อมต่อดึงข้อมูลจากเซิร์ฟเวอร์ได้'
        console.error(err)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped>
.page-container {
  min-height: calc(100vh - 70px);
  background-color: #0f172a; /* Slate-900 */
  color: #f8fafc;
  padding: 3rem 1.5rem;
  font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
}

.content-wrapper {
  max-width: 1100px;
  margin: 0 auto;
}

.header-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
  gap: 1rem;
}

.page-title {
  font-size: 2rem;
  font-weight: 800;
  color: #f8fafc;
  margin-bottom: 0.5rem;
}

.page-subtitle {
  color: #94a3b8;
  font-size: 0.95rem;
}

/* Button Add Style */
.btn-add {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background-color: #0284c7;
  color: #ffffff;
  padding: 0.65rem 1.25rem;
  border-radius: 0.5rem;
  font-weight: 600;
  font-size: 0.9rem;
  text-decoration: none;
  box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
  transition: all 0.2s ease;
  white-space: nowrap;
}

.btn-add:hover {
  background-color: #0369a1;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
}

.btn-icon {
  font-size: 1.1rem;
  line-height: 1;
}

.state-box {
  background-color: #1e293b;
  border-radius: 0.75rem;
  padding: 3rem;
  text-align: center;
  color: #94a3b8;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.state-box.error {
  color: #f87171;
  border-color: rgba(239, 68, 68, 0.2);
}

/* Table Design */
.table-card {
  background-color: #1e293b;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 0.75rem;
  overflow: hidden;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
}

.table-responsive {
  width: 100%;
  overflow-x: auto;
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}

.custom-table th {
  background-color: #1b2436;
  color: #38bdf8;
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  padding: 1rem 1.25rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  white-space: nowrap;
}

.custom-table td {
  padding: 1rem 1.25rem;
  color: #e2e8f0;
  font-size: 0.95rem;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  transition: background-color 0.2s ease;
}

.custom-table tbody tr:hover td {
  background-color: rgba(56, 189, 248, 0.04);
}

.custom-table tbody tr:last-child td {
  border-bottom: none;
}

/* Badges */
.id-badge {
  background-color: rgba(56, 189, 248, 0.1);
  color: #38bdf8;
  padding: 0.2rem 0.5rem;
  border-radius: 0.375rem;
  font-weight: 600;
  font-size: 0.85rem;
}

.username-tag {
  color: #a7f3d0;
  font-weight: 500;
}
</style>