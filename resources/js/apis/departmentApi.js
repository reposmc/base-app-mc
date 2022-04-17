import axios from "axios";

const departmentApi = axios.create({
    baseURL: "/api/web/department",
});

export default departmentApi;
