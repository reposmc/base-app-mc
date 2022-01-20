import axios from "axios";

const departmentApi = axios.create({
    baseURL: "/api/department",
});

export default departmentApi;
