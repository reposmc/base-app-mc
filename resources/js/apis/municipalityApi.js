import axios from "axios";

const municipalityApi = axios.create({
    baseURL: "/api/web/municipality",
});

export default municipalityApi;
