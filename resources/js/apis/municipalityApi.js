import axios from "axios";

const municipalityApi = axios.create({
    baseURL: "/api/municipality",
});

export default municipalityApi;
