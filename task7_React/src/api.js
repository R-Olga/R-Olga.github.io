import {API_URL} from './config.js';

// Доступ к List all meal categories
const getAllCategories = async () => {
    const response = await fetch(API_URL + 'categories.php');
    return await response.json()
}

// Доступ к Lookup full meal details by id
const getMealById = async (idMeal) => {
    const response = await fetch(API_URL + 'lookup.php?i=' + idMeal);
    return await response.json()
}

//Доступ Filter by Category
const getFilterCategory = async (catName) => {
    const response = await fetch(API_URL + 'filter.php?c=' + catName);
    return await response.json()
}

export {getAllCategories, getMealById, getFilterCategory};