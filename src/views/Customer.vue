<template>
  <div class="page-container">
    <div class="content-wrapper">
      <!-- Header Section -->
      <div class="header-section">
        <div>
          <h1 class="page-title">รายชื่อลูกค้า</h1>
          <p class="page-subtitle">จัดการและเรียกดูข้อมูลลูกค้าทั้งหมดในระบบ</p>
        </div>
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
                <th>รหัสลูกค้า</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>เบอร์โทร</th>
                <th>ชื่อผู้ใช้</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in customers" :key="item.customer_id || index">
                <td>{{ index + 1 }}</td>
                <td><span class="id-badge">#{{ item.customer_id }}</span></td>
                <td>{{ item.firstName }}</td>   <!-- ชื่อ -->
                <td>{{ item.lastName }}</td>    <!-- นามสกุล -->
                <td>{{ item.phone }}</td>       <!-- เบอร์โทร -->
                <td><span class="username-tag">@{{ item.username }}</span></td>
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
        const response = await axios.get('http://localhost/project-ict12267/php_api/show_customer.php')
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
  margin-bottom: 2rem;
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