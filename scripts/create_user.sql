CREATE USER 'jar_capital_portal_user'@'%' IDENTIFIED BY 'jar_capital_portal_user_password';
GRANT SELECT,INSERT,UPDATE,DELETE,ALTER,REFERENCES,CREATE ON *.* TO `jar_capital_portal_user`;
