
package br.cefetmg.paoc.database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Conexao {

	private static final String URL_MYSQL = "jdbc:mysql://paoc.cjpzfmkc7gea.us-east-1.rds.amazonaws.com/paoc";
		
	private static final String DRIVER_CLASS = "com.mysql.jdbc.Driver";
		
	private static final String USER = "admin";
	
	private static final String PASS = "LRnl51K5Df8jeGxccnEhezJMtROQSLRcaAqX";

	public static Connection getConnection() {
		System.out.println("Utilizando o banco de dados!");
		try {
			Class.forName(DRIVER_CLASS);
			return DriverManager.getConnection(URL_MYSQL, USER, PASS);
		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			throw new RuntimeException(e);
		}
		return null;
	}
}