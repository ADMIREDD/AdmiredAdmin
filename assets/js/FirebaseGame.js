/**
 * Author: JOSE ROSELLON
 * Date: 29/03/2024
 * Description: These are the classes for managing data from FIREBASE.
 *
 */
class FirebaseGameUser {
  /** Constructor method */
  constructor(idTbody) {
    this.objTbody = document.getElementById(idTbody);
    this.URL = "https://login-firebase-225e1-default-rtdb.firebaseio.com/Api/User";
  }

  /** Method to get user data */
  async getDataUsers() {
    try {
      const response = await fetch(this.URL + ".json");
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      const data = await response.json();
      this.setTableUser(data);
    } catch (error) {
      console.error("Error fetching user data:", error);
    }
  }

  /** Method to get user data by id
   * @param {string} id - User ID
   */
  async getDataUser(id) {
    try {
      const response = await fetch(`${this.URL}/${id}.json`);
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return await response.json();
    } catch (error) {
      console.error("Error fetching user data by ID:", error);
    }
  }

  /** Method to create table rows using user JSON data
   * @param {Object} data - User data
   */
  setTableUser(data) {
    let contRow = 1;
    let rowTable = "";
    let btnActions = "";

    for (const user in data) {
      const getId = `'${user}'`;
      btnActions = `
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
          <button type="button" onclick="showUser(${getId})" class="btn btn-info">
            <img class="img img-fluid" src="./assets/img/icons/eye-fill.svg">
          </button>
          <button type="button" onclick="editUser(${getId})" class="btn btn-warning">
            <img class="img img-fluid" src="./assets/img/icons/pencil-square.svg">
          </button>
          <button type="button" onclick="deleteUser(${getId})" class="btn btn-danger">
            <img class="img img-fluid" src="./assets/img/icons/trash3-fill.svg">
          </button>
        </div>
      `;
      rowTable += `
        <tr>
          <td>${contRow}</td>
          <td>${data[user].nombre || ''}</td>
          <td>${data[user].apellido || ''}</td>
          <td>${data[user].usuario || ''}</td>
          <td class='text-center'>${data[user].tipo_documento_id || ''}</td>
          <td class='text-center'>${data[user].no_documento || ''}</td>
          <td class='text-center'>${data[user].fecha_nacimiento || ''}</td>
          <td class='text-center'>${data[user].email || ''}</td>
          <td class='text-center'>${data[user].telefono || ''}</td>
          <td class='text-center'>${data[user].cargo_id || ''}</td>
          <td class='text-center'>${data[user].torre || ''}</td>
          <td class='text-center'>${data[user].apto || ''}</td>
          <td class='text-center'>${btnActions}</td>
        </tr>
      `;
      contRow++;
    }
    this.objTbody.innerHTML = rowTable;
  }

  /** Method to create a new user
   * @param {Object} data - User data
   */
  async setCreateUser(data) {
    try {
      const response = await fetch(this.URL + ".json", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      await response.json();
      this.getDataUsers();
    } catch (error) {
      console.error("Error creating user:", error);
    }
  }

  /** Method to update user data
   * @param {string} id - User ID
   * @param {Object} data - User data
   */
  async setUpdateUser(id, data) {
    try {
      const response = await fetch(`${this.URL}/${id}.json`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      await response.json();
      this.getDataUsers();
    } catch (error) {
      console.error("Error updating user:", error);
    }
  }

  /** Method to delete a user
   * @param {string} id - User ID
   */
  async setDeleteUser(id) {
    try {
      const response = await fetch(`${this.URL}/${id}.json`, {
        method: "DELETE",
      });
      if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
      return await response.json();
    } catch (error) {
      console.error("Error deleting user:", error);
    }
  }
}
