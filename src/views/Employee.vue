<template>
  <div class="container mt-4">
    <h2 class="mb-3">รายชื่อพนักงาน</h2>
    
    <div class="mb-3">
      <a class="btn btn-primary" href="/add_employee" role="button">Add+</a>
    </div>

    <!-- ตารางแสดงข้อมูลลูกค้า -->
  <table class="table table-bordered table-striped">
  <thead class="table-primary">
    <tr>
      <th>ID</th>
      <th>ชื่อ</th>
      <th>นามสกุล</th>
      <th>เบอร์โทร</th>
      <th>ชื่อผู้ใช้</th>
      <th>ลบ</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="employee in employee" :key="employee.emp_id">
      <td>{{ employee.emp_id }}</td>
      <td>{{ employee.firstName }}</td>
      <td>{{ employee.lastName }}</td>
      <td>{{ employee.phone }}</td>
      <td>{{ employee.username }}</td>
      <!--เพิ่มปุ่มลบ -->
      <td>  
  <button class="btn btn-danger btn-sm" @click="deleteCustomer(employee.emp_id)">ลบ</button>
</td>
    </tr>
  </tbody>
</table>
    <!-- Loading -->
    <div v-if="loading" class="text-center">
      <p>กำลังโหลดข้อมูล...</p>
    </div>

    <!-- Error -->
    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "CustomerList",
  setup() {
    const employee = ref([]);
    const loading = ref(true);
    const error = ref(null);

    // ฟังก์ชันดึงข้อมูลจาก API ด้วย GET
    const fetchEmployee = async () => {
      try {
        const response = await fetch("http://localhost/project-ict12267/php_api/api_employee.php", {
          method: "GET",
          headers: {
            "Content-Type": "application/json"
          }
        });

        if (!response.ok) {
          throw new Error("ไม่สามารถดึงข้อมูลได้");
        }

        const result = await response.json();
        if (result.success) {
          employee.value = result.data;
        } else {
          error.value = result.message;
        }

      } catch (err) {
        error.value = err.message;
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchEmployee();
    });


//ฟังก์ชั่นการลบข้อมูล ***
const deleteEmployee = async (id) => {
  if (!confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?")) return;

  try {
    const response = await fetch("http://localhost/project-ict12267/php_api/api_employee.php", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ emp_id: id })
    });

    const result = await response.json();

    if (result.success) {
      // ลบออกจาก emp ทันที (ไม่ต้องโหลดใหม่)
      employee.value = employee.value.filter(c => c.emp_id !== id);
      alert(result.message);
    } else {
      alert(result.message);
    }

  } catch (err) {
    alert("เกิดข้อผิดพลาด: " + err.message);
  }
};
 

    return {
      employee,
      loading,
      deleteEmployee,   //เรียกใช้งานฟังก์ชั่นการลบข้อมูล ***
      error
    };
  
  
  }
};
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