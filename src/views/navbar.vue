
<template>
    <!-- ================= Navigation Bar ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <!-- ชื่อเว็บไซต์ -->
            <router-link class="navbar-brand fw-bold" to="/">
                Cmaj7n
            </router-link>

            <!-- ปุ่มเมนูมือถือ -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- รายการเมนู -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto">

                    <!-- Home: แสดงทุกสถานะ -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>

                    <!-- ================= Product ================= -->
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                        >
                            Product
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" to="/product">
                                    Product
                                </router-link>
                            </li>

                            <li>
                                <router-link class="dropdown-item" to="/show_product">
                                    Show Product
                                </router-link>
                            </li>
                        </ul>
                    </li>

                    <!-- ================= Customer ================= -->
                    <!-- ยังไม่ Login -->
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" to="/customer">
                            Customer
                        </router-link>
                    </li>

                    <!-- Login แล้ว -->
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link" to="/customer_crud">
                            Customer CRUD
                        </router-link>
                    </li>

                    <!-- ================= Employee ================= -->
                    <!-- ยังไม่ Login -->
                    <li class="nav-item" v-if="!isLoggedIn">
                        <router-link class="nav-link" to="/employee">
                            Employee
                        </router-link>
                    </li>

                    <!-- Login แล้ว -->
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link" to="/employee_crud">
                            Employee CRUD
                        </router-link>
                    </li>

                    <!-- ================= Asset ================= -->
                    <!-- แสดงเฉพาะเมื่อ Login แล้ว -->
                    <li class="nav-item" v-if="isLoggedIn">
                        <router-link class="nav-link" to="/asset">
                            Asset
                        </router-link>
                    </li>

                    <!-- About -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/about">
                            About
                        </router-link>
                    </li>

                    <!-- Contact -->
                    <li class="nav-item">
                        <router-link class="nav-link" to="/contact">
                            Contact
                        </router-link>
                    </li>

                    <!-- ================= Register ================= -->
                    <!-- แสดงเฉพาะเมื่อยังไม่ Login -->
                    <li class="nav-item dropdown" v-if="!isLoggedIn">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown"
                        >
                            Register
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <router-link class="dropdown-item" to="/add_customer">
                                    Register
                                </router-link>
                            </li>

                            <li>
                                <router-link class="dropdown-item" to="/login">
                                    Login
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>

                <!-- ================= User Information ================= -->
                <!-- แสดงเฉพาะเมื่อ Login แล้ว -->
                <div
                    class="d-flex align-items-center ms-lg-3 mt-2 mt-lg-0"
                    v-if="isLoggedIn"
                >
                    <span class="text-white me-3">
                        <i class="bi bi-person-circle"></i>
                        {{ userName }}
                    </span>

                    <button
                        @click="logout"
                        class="btn btn-danger btn-sm"
                    >
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </div>

            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: "Navbar",

    data() {
        return {
            // สถานะ Login
            isLoggedIn: false,

            // ชื่อผู้ใช้งาน
            userName: ""
        };
    },

    // ทำงานเมื่อ Component ถูกสร้าง
    mounted() {
        this.checkLogin();
    },

    methods: {

        // ตรวจสอบสถานะ Login
        checkLogin() {

            this.isLoggedIn =
                localStorage.getItem("adminLogin") === "true";

            if (this.isLoggedIn) {

                try {
                    // อ่านข้อมูลผู้ใช้
                    const userData = localStorage.getItem("user");

                    const user = userData
                        ? JSON.parse(userData)
                        : null;

                    // กำหนดชื่อผู้ใช้
                    this.userName =
                        user?.name || user?.username || "Admin";

                } catch (error) {
                    this.userName = "Admin";
                }

            } else {
                this.userName = "";
            }
        },

        // ออกจากระบบ
        logout() {

            // ลบข้อมูล Login
            localStorage.removeItem("adminLogin");
            localStorage.removeItem("user");

            // รีเซ็ตสถานะ
            this.isLoggedIn = false;
            this.userName = "";

            // กลับหน้า Login
            this.$router.push("/login");
        }
    },

    // ตรวจสอบสถานะใหม่เมื่อเปลี่ยนหน้า
    watch: {
        '$route'() {
            this.checkLogin();
        }
    }
};
</script>
