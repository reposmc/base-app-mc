import axios from "axios";

const departmentApi = axios.create({
    baseURL: "/api/web/role",
});

export default departmentApi;
