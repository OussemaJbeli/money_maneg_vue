<template>
    <div>
      <input v-model="searchQuery" placeholder="Search by Name" />
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Password</th>
            <!-- other table headers -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in filteredItems" :key="item.name">
            <td>{{ item.name }}</td>
            <td>{{ item.pass }}</td>
            <!-- display other item properties -->
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchQuery: '',
        items: [
          { name: 'John', pass: 'test1' },
          { name: 'Alice', pass: 'test1' },
          { name: 'Bob', pass: 'test1' },
          { name: 'Eva', pass: 'test1' },
          { name: 'Michael', pass: 'test1' },
          { name: 'Olivia', pass: 'test1' },
          { name: 'David', pass: 'test1' },
          { name: 'Sophia', pass: 'test1' },
          { name: 'Daniel', pass: 'test1' },
          { name: 'Emma', pass: 'test1' }
        ]
      };
    },
    computed: {
      filteredItems() {
        const query = this.searchQuery.toLowerCase();
        return this.items.filter(item => item.name.toLowerCase().includes(query));
      }
    }
  };
  </script>
  