import axios from "axios";

const departmentApi = axios.create({
    baseURL: "/api/role",
});

export default departmentApi;
