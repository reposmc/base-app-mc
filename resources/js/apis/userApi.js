import axios from "axios";

const culturaHouseApi = axios.create({
    baseURL: "/api/web/user",
});

export default culturaHouseApi;
