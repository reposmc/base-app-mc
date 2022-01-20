import axios from "axios";

const culturaHouseApi = axios.create({
    baseURL: "/api/user",
});

export default culturaHouseApi;
