# Task List/Lista de tarefas (PHP)
---
## Banco de dados/Database
---
#### **Database name:** "tasklist";

#### **Table/tabela:** "tarefas";


| Colunas/Columns | Tipo/Type| Padrão/Default|
| ------ | ----------- |------|
| id   | **int(11)** | PRIMARY KEY AUTO_INCREMENT |
| tarefa | **varchar(220)** |
| created | **datetime** | current_timestamp()	 |
| checked | **boolean** |0|
---
##### **Feito por/Made by:** Arthur de Oliveira Silva