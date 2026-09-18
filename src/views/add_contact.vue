<template>
  <div class="page-container">
    <div class="content-wrapper">
      <!-- Header Section -->
      <div class="header-section">
        <div>
          <h1 class="page-title">เพิ่มข้อมูลการติดต่อ</h1>
          <p class="page-subtitle">กรอกรายละเอียดเพื่อบันทึกข้อมูลการติดต่อใหม่ลงในระบบ</p>
        </div>
        <router-link to="/contact" class="btn-back">
          &larr; ย้อนกลับ
        </router-link>
      </div>

      <!-- Form Card -->
      <div class="form-card">
        <form @submit.prevent="submitForm">
          <!-- หัวข้อ -->
          <div class="form-group">
            <label for="subject">หัวข้อการติดต่อ <span class="required">*</span></label>
            <input 
              type="text" 
              id="subject" 
              v-model="form.subject" 
              placeholder="ระบุหัวข้อ เช่น สอบถามข้อมูลการสมัครเรียน" 
              required
            />
          </div>

          <!-- ชื่อ-นามสกุล -->
          <div class="form-group">
            <label for="fullname">ชื่อ-นามสกุล <span class="required">*</span></label>
            <input 
              type="text" 
              id="fullname" 
              v-model="form.fullname" 
              placeholder="ระบุชื่อและนามสกุล" 
              required
            />
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">อีเมล (Email) <span class="required">*</span></label>
            <input 
              type="email" 
              id="email" 
              v-model="form.email" 
              placeholder="example@domain.com" 
              required
            />
          </div>

          <!-- รายละเอียด -->
          <div class="form-group">
            <label for="detail">รายละเอียด <span class="required">*</span></label>
            <textarea 
              id="detail" 
              v-model="form.detail" 
              rows="4" 
              placeholder="กรอกรายละเอียดการติดต่อเพิ่มเติม..." 
              required
            ></textarea>
          </div>

          <!-- Action Buttons -->
          <div class="form-actions">
            <button type="button" @click="resetForm" class="btn-secondary" :disabled="submitting">
              ล้างข้อมูล
            </button>
            <button type="submit" class="btn-submit" :disabled="submitting">
              <span v-if="submitting">กำลังบันทึก...</span>
              <span v-else>บันทึกข้อมูล</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AddContactView',
  data() {
    return {
      form: {
        subject: '',
        fullname: '',
        email: '',
        detail: ''
      },
      submitting: false
    }
  },
  methods: {
    async submitForm() {
      this.submitting = true
      try {
        const response = await axios.post('http://localhost/project-ict12267/php_api/show_contact.php', this.form)
        
        // เช็คผลลัพธ์จาก PHP API (ปรับเงื่อนไขตามความเหมาะสมของ API)
        if (response.data.status === 'success' || response.status === 200) {
          alert('บันทึกข้อมูลสำเร็จ!')
          this.$router.push('/contact') // บันทึกเสร็จแล้วเด้งกลับไปหน้าตาราง
        } else {
          alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล')
        }
      } catch (error) {
        console.error('Error adding contact:', error)
        alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบการเชื่อมต่อ API')
      } finally {
        this.submitting = false
      }
    },
    resetForm() {
      this.form = {
        subject: '',
        fullname: '',
        email: '',
        detail: ''
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
  max-width: 700px;
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

.btn-back {
  color: #38bdf8;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  padding: 0.5rem 1rem;
  border-radius: 0.375rem;
  background-color: rgba(56, 189, 248, 0.1);
  transition: all 0.2s ease;
  white-space: nowrap;
}

.btn-back:hover {
  background-color: rgba(56, 189, 248, 0.2);
}

/* Form Card */
.form-card {
  background-color: #1e293b;
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 0.75rem;
  padding: 2rem;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
}

.form-group {
  margin-bottom: 1.5rem;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.form-group label {
  font-size: 0.9rem;
  font-weight: 600;
  color: #e2e8f0;
}

.required {
  color: #f87171;
}

.form-group input,
.form-group textarea {
  width: 100%;
  padding: 0.75rem 1rem;
  background-color: #0f172a;
  border: 1px solid #334155;
  border-radius: 0.5rem;
  color: #f8fafc;
  font-size: 0.95rem;
  outline: none;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #38bdf8;
  box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
  color: #64748b;
}

/* Form Actions */
.form-actions {
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
  margin-top: 2rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.btn-submit {
  background-color: #0284c7;
  color: #ffffff;
  border: none;
  padding: 0.75rem 1.5rem;
  border-radius: 0.5rem;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
  transition: all 0.2s ease;
}

.btn-submit:hover:not(:disabled) {
  background-color: #0369a1;
  transform: translateY(-1px);
}

.btn-submit:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

.btn-secondary {
  background-color: #334155;
  color: #cbd5e1;
  border: none;
  padding: 0.75rem 1.25rem;
  border-radius: 0.5rem;
  font-weight: 600;
  font-size: 0.95rem;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.btn-secondary:hover:not(:disabled) {
  background-color: #475569;
  color: #ffffff;
}
</style>