<!-- File: /app/View/Phones/index.ctp -->

<h1>Phones DB</h1>
<p><?php echo $this->Html->link('Add Phone', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
		<th>Manufacturer</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $phones array, printing out phone info -->

    <?php foreach ($phones as $phone): ?>
    <tr>
        <td><?php echo $phone['Phone']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $phone['Phone']['name'],
                    array('action' => 'view', $phone['Phone']['id'])
                );
            ?>
        </td>
		<td><?php echo $phone['Phone']['manufacturer']; ?></td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $phone['Phone']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $phone['Phone']['id'])
                );
            ?>
        </td>
        <td>
            <?php echo $phone['Phone']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>