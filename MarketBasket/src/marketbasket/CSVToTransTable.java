/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package marketbasket;

import JSON.JSONArray;
import JSON.JSONObject;
import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.io.Reader;
import java.nio.charset.Charset;

/**
 *
 * @author inspirin
 */
public class CSVToTransTable {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        convertData(null);
    }
    
    public static boolean convertData(String file) {
        boolean b = false;
        try {
            // file = "G://Online Retail2.csv";
            Reader fileReader = new InputStreamReader(new FileInputStream(new File(file)), Charset.forName("UTF-8"));
            
            BufferedReader bufferedReader = new BufferedReader(fileReader);
            
            String line;
            String temp = "";
            JSONArray jSONArrayFinal = new JSONArray();
            
            JSONArray jSONArray = new JSONArray();
            //read line by line
            while ((line = bufferedReader.readLine()) != null) {
                String arr[] = line.split(",");
                if (temp.equals(arr[0]) || temp.equals("")) {
                    temp = arr[0];
                    JSONObject jSONObject = new JSONObject();
                    jSONObject.put("invoice_id", arr[0]);
                    String stock_code = arr[1].replace("A", "1");
                    stock_code = stock_code.replaceAll("B", "2");
                    stock_code = stock_code.replaceAll("C", "3");
                    stock_code = stock_code.replaceAll("D", "4");
                    stock_code = stock_code.replaceAll("E", "5");
                    stock_code = stock_code.replaceAll("F", "6");
                    stock_code = stock_code.replaceAll("G", "7");
                    stock_code = stock_code.replaceAll("[^0-9]", "1");
                    if (stock_code.length() > 5) {
                        stock_code = stock_code.substring(0, 5);
                    }
                    
                    int stock_value = Integer.parseInt(stock_code) % 100;
                    jSONObject.put("stock_code", stock_value);
                    jSONObject.put("quantity", arr[3]);
                    jSONObject.put("price", arr[5]);
                    jSONArray.put(jSONObject);
                    System.out.println("line=" + arr[0] + ",s" + stock_value + "," + arr[3] + "," + arr[5]);
                    
                } else if (temp.length() > 0) {
                    System.out.println("value changed");
                    jSONArrayFinal.put(jSONArray);
                    
                    jSONArray = new JSON.JSONArray();
                    temp = arr[0];
                    JSON.JSONObject jSONObject = new JSONObject();
                    jSONObject.put("invoice_id", arr[0]);
                    String stock_code = arr[1].replace("A", "1");
                    stock_code = stock_code.replaceAll("B", "2");
                    stock_code = stock_code.replaceAll("C", "3");
                    stock_code = stock_code.replaceAll("D", "4");
                    stock_code = stock_code.replaceAll("E", "5");
                    stock_code = stock_code.replaceAll("F", "6");
                    stock_code = stock_code.replaceAll("G", "7");
                    stock_code = stock_code.replaceAll("[^0-9]", "1");
                    if (stock_code.length() > 5) {
                        stock_code = stock_code.substring(0, 5);
                    }
                    int stock_value = Integer.parseInt(stock_code) % 100;
                    jSONObject.put("stock_code", stock_value);                    
                    jSONObject.put("quantity", arr[3]);
                    jSONObject.put("price", arr[5]);
                    jSONArray.put(jSONObject);
                    System.out.println("line=" + arr[0] + ",s" + stock_value + "," + arr[3] + "," + arr[5]);
                }
                
            }
            System.out.println("total json size" + jSONArrayFinal.length());
            System.out.println("######################################");
            try {
                PrintWriter pw = new PrintWriter("test_two_phase.txt");
                PrintWriter pwForApriori = new PrintWriter("test_apriori.txt");
                
                int count = 0;
                while (count < jSONArrayFinal.length()) {
                    JSONArray jsonArray1 = jSONArrayFinal.getJSONArray(count);
                    int count1 = 0;
                    String stock_code = "";
                    String total_utility = "";
                    double total_profit = 0;
                    System.out.println("-----***********************-------------------");
                    
                    while (count1 < jsonArray1.length()) {
                        try {
                            
                            int temp_stock_code = jsonArray1.getJSONObject(count1).getInt("stock_code");
                            String quan_temp = jsonArray1.getJSONObject(count1).getString("quantity");
                            String price_temp = jsonArray1.getJSONObject(count1).getString("price");
                            
                            if (count1 == 0) {
                                System.out.println("#" + temp_stock_code + "," + quan_temp + "," + price_temp);
                                
                                int quan = Integer.parseInt(quan_temp);
                                
                                double price = Double.parseDouble(price_temp);
                                
                                double utility = quan * price;
                                total_utility = "" + (int) utility;
                                total_profit = total_profit + utility;
                                stock_code = "" + temp_stock_code;
                            } else {
                                System.out.println("#" + temp_stock_code + "," + quan_temp + "," + price_temp);
                                
                                int quan = Integer.parseInt(quan_temp);
                                
                                double price = Double.parseDouble(price_temp);
                                
                                double utility = quan * price;
                                total_utility = total_utility + " " + (int) utility;
                                total_profit = total_profit + utility;
                                stock_code = stock_code + " " + temp_stock_code;
                            }
                            
                            if (count1 == (jsonArray1.length() - 1)) {
                                System.out.println("%%" + stock_code + ":" + total_profit + ":" + total_utility);
                                pwForApriori.append(stock_code + System.getProperty("line.separator"));
                                pw.append(stock_code + ":" + (int) total_profit + ":" + total_utility + System.getProperty("line.separator"));
                                b = true;
                            }
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                        
                        count1++;
                    }
                    count++;
                }
                pw.close();
                pwForApriori.close();
            } catch (Exception e) {
                e.printStackTrace();
            }
            
        } catch (Exception e) {
            System.out.println("An exception occured in writing the pdf text to file.");
            e.printStackTrace();
        }
        return b;
    }
    
    static void writeTexttoFile(String pdfText, String fileName) {
        
        try {
            PrintWriter pw = new PrintWriter(fileName);
            
            pw.append(pdfText);
            pw.close();
        } catch (Exception e) {
            System.out.println("An exception occured in writing the pdf text to file.");
            e.printStackTrace();
        }
        System.out.println("Done.");
    }
}
