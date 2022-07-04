<div class="main_content sub_wrapper">
        <div class="header">
                <h1>Modules</h1>
                <?php
                        if (session()->getTempdata('error')) {
                                echo session()->getTempdata('error');
                        }
                        ?>
                <div class="dash-button">
                         <a href="<?= base_url('dashboard/modules/add_module'); ?>">Add Modules</a>
                         <style>
                                .dash-button:hover{
                                        background-color: #4CAF50; /* Green */
                                        width: 10%;
                                        text-align: center;
                                        color: white;
                                        transition-duration: 0.4s;
                                }

                                .dash-button{
                                        background-color: #115740;
                                        width: 10%;
                                        text-align: center;
                                        color: white;
                                        margin-top: 20px;
                                        margin-bottom: 20px;
                                }
                         </style>
                </div>

        </div>
        <main>
                <style>
table, th, td {
  border: 1px solid black;
}

th, td{
        padding:10px;
}
</style>
        <table>
                <tr>
                        <th>Module Name</th>
                        <th>Module ID</th>
                        <th>Course</th>
                        <th>Module Leader</th>
                        <th>Credit</th>
                        <th>Status</th>
                        <th>Actions</th>
                </tr>

                <?php  foreach($moduleData as $modules):?>
                <tr>
                        <td><?= $modules->module_name?></td>
                        <td><?= $modules->module_ID?></td>
                        <td><?= $modules->course?></td>
                        <td><?= $modules->module_leader?></td>
                        <td><?= $modules->credit_score?></td>
                        <td><?= $modules->module_status?></td>
                        <td><ul>
                                <a href="<?= base_url('dashboard/modules/edit_module/'.$modules->id); ?>"><li><i class="fa-solid fa-pen-to-square"></i> edit</li></a>
                                <a href="<?= base_url('dashboard/modules/delete_module/'.$modules->id);?>"><li><i class="fa-solid fa-trash"></i> delete</li></a>
                        </ul></td>
                        
                </tr>
                        <?php endforeach; ?>
        </table>

        </main>
        <footer>

        </footer>
</div>
</div>
</div>
</body>
</html>