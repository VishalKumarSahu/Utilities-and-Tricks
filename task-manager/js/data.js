/*
Create a simple task manager using html css and javascript.This task manager has 2 vertical sections:
- Todo: List of tasks to be done
- Done: List of tasks which have already been done.

Each task will have a name and a description. 
There should be an empty form on the top of the 'Todo' list. 
A user can create a task in the 'Todo' list  by filling up that form. 
Once the task is done, he/she can move that task to the 'Done' section. 
You can either implement this using a button called 'Done' on every task on the 'Todo' list 
or by dragging and dropping the task from one list to another. 
The user should be able to see his/her lists whenever he/she opens the app in the browser. 
For this you will need to save the list in localStorage every time a change has been made in the list.https://www.w3schools.com/jsref/prop_win_localstorage.asp


You are free to use any css framework or not to use it. However you can only use pure Javascript.

*/

// One has to load the tasks from localStorage
// Copy and paste the following in your console to see how you can store it in localStorage:
// - localStorage.setItem("tm_list", JSON.stringify([{ name: "Create HTML and CSS", description: "Simple layout wth HTML and CSS" }]))
// - localStorage.getItem("tm_list")
// - JSON.parse(localStorage.getItem("tm_list"))

// new Date().valueOf()

// Alternative choice of list structure 
let tasks = [
	// {
	// 	title: "Task Title",
	// 	description: "Task Description",
	// 	date_added: 1623951099481,
	// 	date_last_updated: 1623951099481,
	// 	status: 0
	// }
];
